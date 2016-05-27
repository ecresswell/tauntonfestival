#!/usr/bin/env python3
import requests
import sys
import re
import math
from operator import itemgetter

input_file = 'delimited_programme.txt'

## a date has many events, each event has many contestants
## an event has a time, a number, a title and an age range
## contestants are ordered

date_regex = r'^@(?P<date>.*)$'
event_info_regex = r'^[ \t]*(?P<time>[0-9]?[0-9](?:\.[0-9][0-9])?)[ \t]+(?P<number>[0-9a-zA-Z]+)[ \t]+(?P<title>.*?)[ \t]+(?P<age>[0-9].*?)?[ \t]*$'
contestants_regex = r'^[ \t]*(?P<n1>[0-9]+)[ \t]+(?P<c1>[^0-9]+)[ \t]*(?:(?P<n2>[0-9]+)[ \t]+(?P<c2>[^0-9]+?))?[ \t]*$'
delimiter_regex = r'^###[\t ]*$'
break_regex = r'^[ \t]*(?P<time>[0-9]?[0-9]\.[0-9][0-9])[ \t]+(?P<thing>.*?)[ \t]*$'

def parse_prog(file):
    current_day = -1
    current_event = -1
    prog = []

    for line in file:
        line = line.strip('\r\n')

        if re.match('^[ \t]*$', line) is not None:
            continue

        # Date
        date_match = re.match(date_regex, line)
        if date_match is not None:
            current_day += 1
            current_event = -1
            prog.append((date_match.group('date'), []))
            continue

        # Contestants
        c_match = re.match(contestants_regex, line)
        if c_match is not None:
            (date, events) = prog[current_day]
            (time, number, title, age, cs) = events[current_event]

            c1_name = re.sub(r'[ \t][ \t]', ' ', c_match.group('c1').strip())
            c1 = (int(c_match.group('n1')), c1_name)
            cs.append(c1)

            if c_match.group('n2') is not None:
                c2_name = re.sub(r'[ \t][ \t]', ' ', c_match.group('c2').strip())
                c2 = (int(c_match.group('n2')), c2_name)
                cs.append(c2)
            continue

        # Event Info
        ei_match = re.match(event_info_regex, line)
        if ei_match is not None:
            current_event += 1
            event = (
            ei_match.group('time'), ei_match.group('number'), ei_match.group('title'), ei_match.group('age'), [])
            (date, events) = prog[current_day]
            events.append(event)
            continue

        # Breaks etc
        break_match = re.match(break_regex, line)
        if break_match is not None:
            current_event += 1
            pause = (break_match.group('time'), break_match.group('thing'), '', '', [])
            (date, events) = prog[current_day]
            events.append(pause)
            continue

        # Delimiter
        if re.match(delimiter_regex, line) is not None:
            # not doing anything with this at the moment
            continue

        if re.match('^Finish[ \t]*', line) is not None:
            (date, events) = prog[current_day]
            events.append(('Finish', '', '', '', []))
            continue

        raise ValueError('Could not parse line "%s"' % line)
    return prog


def output_prog_to_md(prog):
    print ('''---
layout: dance
title: Dance Programme 2016
---

''')

    for (date, events) in prog:
        print('## <a href="#%s">%s</a>\r\n' % (date, date))

    print ('<section class="title"></section>\r\n')

    cell_width = -1
    for (date, events) in prog:
        for (time, number, title, age, cs) in events:
            for (n, c) in cs:
                if len(c) > cell_width:
                    cell_width = len(c)

    for (date, events) in prog:
        print('## <a name="%s">%s</a>\r\n' % (date, date))
        print('{:.easy-table easy-table-default}')
        for (time, number, title, age, cs) in events:
            if len(cs) > 0:
                print('|**%s**|**%s - %s**| |**%s**|' % (time, number, title, age))
            else:
                print('|**%s**|**%s**| | |' % (time, number))

            scs = sorted(cs, key = itemgetter(0))
            max_left = math.ceil(len(cs) / 2)
            for i in range(0, max_left):
                if i + max_left < len(cs):
                    print('|%s|%s|%s|%s|' % (str(scs[i][0]).ljust(2), scs[i][1].ljust(cell_width),
                                             str(scs[i + max_left][0]).ljust(2), scs[i + max_left][1].ljust(cell_width)))
                else:
                    print('|%s|%s| | |' % (scs[i][0], scs[i][1]))
        print('\r\n<section class="title"></section>\r\n')


def main():
    with open(input_file, 'r') as f:
        prog = parse_prog(f)

    output_prog_to_md(prog)
    return
'''
    for (date, events) in prog:
        print(date)
        for (time, number, title, age, cs) in events:
            print('- %s, %s, %s, %s, %s' % (time, number, title, age, len(cs)))
            for (n, c) in sorted(cs, key = itemgetter(0)):
                print(' \- %s %s' % (n, c))
'''

if __name__ == '__main__':
    main()