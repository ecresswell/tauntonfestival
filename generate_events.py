#!/usr/bin/env python
import csv
import sys
import re
import datetime

input_xml = 'C:/myprojects/tauntonfestival-master/events.txt'
events_output_dir = r'C:/myprojects/tauntonfestival/_events'

events_template = """---
layout: event
title: $TITLE
date: $DATE
publish_date: $PUBLISH_DATE
start_date: $START_DATE
end_date: $END_DATE
time: $TIME
location: $LOCATION
---
$DETAILS
"""

def slugify(s):
    s = s.lower()
    for c in [' ', '-', '.', '/']:
        s = s.replace(c, '_')
    s = re.sub('\W', '', s)
    s = s.replace('_', ' ')
    s = re.sub('\s+', ' ', s)
    s = s.strip()
    s = s.replace(' ', '-')
    return s

def generate_events_page(s_start_date, s_end_date, time, title, location, details, s_published):
    start_date = datetime.datetime.strptime(s_start_date, '%Y-%M-%d')
    start_date = start_date.strftime('%Y-%m-%d')
    end_date = ''
    if s_end_date is not '':
        end_date = datetime.datetime.strptime(s_end_date, '%Y-%M-%d')
        end_date = end_date.strftime('%Y-%m-%d')
    published = datetime.datetime.strptime(s_published, '%Y-%M-%d')
    return events_template.replace('$TITLE', title).replace('$START_DATE', start_date).replace('$END_DATE', end_date).replace('$PUBLISH_DATE', published.strftime('%Y-%m-%d 09:00:00')).replace('$TIME', time).replace('$LOCATION', location).replace('$DETAILS', details).replace('$DATE', start_date)
    
def get_page_name(title, start_date):
    parsed_date = datetime.datetime.strptime(start_date, '%Y-%M-%d')
    slug = slugify(title)
    return parsed_date.strftime('%Y-%m-%d') + '-' + slug + '.md'

def main():
    with open(input_xml, 'r') as f:
        reader = csv.reader(f, delimiter = '\t')
        for start_date, end_date, time, title, location, details, published in reader:
            page = generate_events_page(start_date, end_date, time, title, location, details, published)
            page_name = get_page_name(title, start_date)
            output_path = events_output_dir + '/' + page_name
            print page_name
            sys.stdout.flush()
            with open(output_path, 'w') as output_file:
                output_file.write(page)


if __name__ == '__main__':
    main()