#!/usr/bin/env python
import re
import urllib2
import datetime
import os
import sys

input_xml = 'http://www.tauntonfestival.org.uk/sitemap-posttype-post.xml'
news_output_dir = r'C:/myprojects/tauntonfestival/_news'
reports_output_dir = r'C:/myprojects/tauntonfestival/_reports'

news_template = """---
layout: news
title: $TITLE
date: $DATE
redirect_from: "/$URL"
---
<section>
$CONTENT
</section>
"""

report_template = """---
layout: report
title: $TITLE
tags: $TAGS
date: $DATE
redirect_from: "/$URL"
---
<section>
$CONTENT
</section>
"""

def get_post_info(url):
    response = urllib2.urlopen(url)
    html = response.read()
    title = re.findall(r'<h2 class="page-title">(.*?)</h2>', html)
    date = re.findall(r'<section class="metaline">Published (.*?) by .*?</section>', html)
    tags = get_tags(html)
    content = re.findall(r'<section class="entry single">(.*?)</section>', html, re.S)
    return (title, date, content, tags)
    
def get_tags(html):
    result = []
    tags_temp = re.findall(r'<section class="metaline">.* in (.*?)</section>', html)
    return re.findall(r'rel="category tag">(.*?)</a>', tags_temp[0])
    
def generate_news_page(rel_url, title, date, content):
    content = fix_links_in_content(content)
    return news_template.replace('$TITLE', title).replace('$URL', rel_url).replace('$DATE', date.strftime('%Y-%m-%d 09:00:00')).replace('$CONTENT', content)

def generate_report_page(rel_url, title, date, content, tags):
    content = fix_links_in_content(content)
    tag_string = '\n - '.join([''] + tags)
    return report_template.replace('$TITLE', title).replace('$URL', rel_url).replace('$DATE', date.strftime('%Y-%m-%d 09:00:00')).replace('$CONTENT', content).replace('$TAGS', tag_string)
    
def fix_links_in_content(content):
    # href="/2014/03/annual-general-meeting-26th-march-2014/"
    # href="http://www.tauntonfestival.org.uk/wp-content/uploads/2014/09/TauntonFestival_2015_Syllabus.pdf"
    # onclick="_gaq.push(['_trackEvent','download','http://www.tauntonfestival.org.uk/wp-content/uploads/2014/09/TauntonFestival_2015_Syllabus.pdf']);"
    content = re.sub(r'href="/(.*?)"', r'href="{{ "/\1" | prepend: site.github.url }}"', content)
    content = re.sub(r'href="http://www.tauntonfestival.org.uk(.*?)"', r'href="{{ "\1" | prepend: site.github.url }}"', content)
    content = re.sub(r' onclick="_gaq.*?;"', r'', content)
    return content
    
def relative_url(url):
    return url.replace('http://www.tauntonfestival.org.uk/', '')
    
def get_page_name(rel_url, date):
    slug = re.findall(r'..../../(.*?)/', rel_url)[0]
    return date.strftime('%Y-%m-%d') + '-' + slug + '.md'

def main():
    response = urllib2.urlopen(input_xml)
    html = response.read()
    posts = re.findall(r"<loc>(.*?)</loc>", html)
    
    for post in posts:
        (title, date, content, tags) = get_post_info(post)
        rel_url = relative_url(post)
        parsed_date = datetime.datetime.strptime(date[0], '%B %d, %Y')
        happy_title = title[0].replace(':', '-')
        page_name = get_page_name(rel_url, parsed_date)
        
        if len(tags) is 1 and 'News' in tags:
            post_md = generate_news_page(rel_url, happy_title, parsed_date, content[0])
            page = news_output_dir + '/' + page_name
        elif 'News' in tags:
            raise ValueError('Found post that is news & other stuff - ' + page_name)
        else:
            post_md = generate_report_page(rel_url, happy_title, parsed_date, content[0], tags)
            page = reports_output_dir + '/' + page_name

        print page
        sys.stdout.flush()
        with open(page, "w") as file:
            file.write(post_md)
        #print page_name
        #print post_md
        #print '%s - %s' % (post, post_info)

if __name__ == '__main__':
    main()