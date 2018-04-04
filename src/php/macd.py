from __future__ import unicode_literals
import csv
import os,sys
from unittest import TestCase
# from hamcrest import greater_than, assert_that, equal_to, close_to, contains, \
#     none, only_contains
from numpy import isnan
import pandas as pd
from stockstats import StockDataFrame as Sdf
import time

date = time.strftime('%m-%d-%Y', time.localtime(time.time()))
date_1 = time.strftime('%Y%m%d', time.localtime(time.time()))
filename = './hist_data/' + sys.argv[1] + '-hist-' + date + '.csv'
filename_r = './hist_data/' + sys.argv[1] + '-hist-' + date + '_r.csv'

c = open(filename, 'r')
r = open(filename_r, 'w')
# line = c.readlines()
# read = csv.reader(c)
size = 0
r.writelines('Date,Open,High,Low,Close,Volume,Adj Close\n')
for line in reversed(c.readlines()):
        if line != 'Date,Open,High,Low,Close,Volume,Adj Close\n':
                r.writelines(line.replace('-', ''))
                size += 1
r.close()
c.close()

stock = Sdf.retype(pd.read_csv(filename_r))
macd =  stock.get('macd')
record = macd.ix[20170413]
print record