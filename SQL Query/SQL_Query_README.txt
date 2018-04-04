CreateDatabase.php : create a database containing 5 companies.
ImportData.php : import history and real time data.
Showlatest.php : Show the list of all companies in the database along with their latest stock price (real time latest stock price).
Gethigh.php : get the highest stock price of any company in the last ten days.
Avgprice.php : get the average stock price of any company in the latest one year.
Getlow.php : get the lowest stock price for any company in the latest one year.
Listlowcom.php : List the ids of companies along with their name who have the average stock price lesser than the lowest of any of the Selected Company in the latest one year.



Our database is built in MAMP. Just put all these files into file htdocs of MAMP.

To change the input data path, please go to ImportData.php. Change the csv_path in line 40 and line 98.
