#!/usr/bin/env python
import re
import urllib2
import datetime
import os

input_xml = 'http://www.tauntonfestival.org.uk/sitemap-posttype-post.xml'
output_dir = r'C:/myprojects/tauntonfestival/news'

template = """---
layout: page
title: $TITLE
special: news
date: $DATE
permalink: "/news/$URL"
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
    content = re.findall(r'<section class="entry single">(.*?)</section>', html, re.S)
    return (title, date, content)
    
def generate_news_page(rel_url, title, date, content):
    return template.replace('$TITLE', title).replace('$URL', rel_url).replace('$DATE', date.strftime('%Y-%m-%d 09:00:00')).replace('$CONTENT', content)
    
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
        (title, date, content) = get_post_info(post)
        rel_url = relative_url(post)
        parsed_date = datetime.datetime.strptime(date[0], '%B %d, %Y')
        happy_title = title[0].replace(':', '-')
        post_md = generate_news_page(rel_url, happy_title, parsed_date, content[0])
        page_name = get_page_name(rel_url, parsed_date)
        page = output_dir + '/' + page_name
        print page
        with open(page, "w") as file:
            file.write(post_md)
        #print page_name
        #print post_md
        #print '%s - %s' % (post, post_info)

if __name__ == '__main__':
    main()