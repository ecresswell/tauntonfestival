#!/usr/bin/env python3
import requests
import sys
import re

input_xmls = ['sitemap-posttype-page.xml', 'sitemap-posttype-post.xml']

def test_link(url):
    r = requests.get(url)
    code = r.status_code
    if code is 200:
        print('    200 %s' % (url))
    else:
        print('!!! %i %s' % (code, url))
        
def fix_url(url):
    #return re.sub('http://www.tauntonfestival.org.uk', 'http://ecresswell.github.io/tauntonfestival', url)
    return url

def main():
    for input_xml in input_xmls:
        with open(input_xml, 'r') as f:
            print(input_xml)
            content = f.read()
            for url in re.findall(r'<loc>(http://www.tauntonfestival.org.uk/.*?)</loc>', content):
                url = fix_url(url)
                test_link(url)

if __name__ == '__main__':
    main()