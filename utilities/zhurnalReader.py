#coding:utf-8
import csv
from xml.etree.ElementTree import Element, SubElement, ElementTree, dump

CSV_FILE_NAME = 'זשורנאַל־דאַטנבאַזע.csv'
OUTPUT = 'zhurnaln.xml'

def csv_reader(csv_file):
    "returns list of lists, the contents of the csv file"
    zhurnalReader = csv.reader(open(csv_file, newline="", encoding='utf-8'))
    lol = []
    for row in zhurnalReader:
        lol.append(row)
    return lol
        
class ZhurnalTree(ElementTree):
    def __init__(self):
        ElementTree.__init__(self, Element('zhurnaln'))

    def hasIssue(self, number):
        "checks if the database already has an element for the given issue"
        return str(number) in [issue.attrib['num'] for
                               issue in self.findall('issue')]

    def addIssue(self, number):
        "adds issue element in appropriate place in database hierarchy"
        SubElement(self.getroot(), 'issue', num=str(number))

    def addArticle(self, issue_num, page_num, title,
                   author, category, tags):
        'add article with given parameters to correct issue'
        article_attribs = {'page':str(page_num)}
        if category: article_attribs['category'] = category
        #the article element is built up and then added to the issue
        article = Element('article', article_attribs)
        title_elem = SubElement(article, 'title')
        title_elem.text = title
        if author:
            author_elem = SubElement(article, 'author')
            author_pieces = author.split()
            lastname = SubElement(author_elem, 'familye')
            lastname.text = author_pieces[-1]
            if len(author_pieces) > 1:
                rest = SubElement(author_elem, 'rest')
                rest.text = ' '.join(author_pieces[:-1])
        for tag in tags:
            tag_elem = SubElement(article, 'tag')
            tag_elem.text = tag
        #find issue with the correct number:
        issue_elem = [issue for issue in self.findall('issue')
                      if issue.attrib['num'] == issue_num][0]
        issue_elem.append(article)
        

def csv2elementtree(lol):
    'converts list of list from csv file to element object'
    assert lol[0] == ['טיטל', 'מחבר', 'זשורנאַל', 'זײַטל', 'קאַטעגאַריע', 'שליסל־װערטער', 'sort']
    database = ZhurnalTree()
    for record in lol[1:]:
        assert len(record) >= 4
        if len(record) < 5:
            record.append('')
        title, author, issue_num, page_num, category = record[:5]
        if len(record) < 6:
            tags = []
        elif record[5] == '':
            tags = []
        else:
            tags = record[5].split(',')
        if not database.hasIssue(issue_num):
            database.addIssue(issue_num)
        database.addArticle(issue_num, page_num, title, author, category, tags)
    return database

def main():
    tree = csv2elementtree(csv_reader(CSV_FILE_NAME))
    tree.write(OUTPUT, 'utf-8')

main()
