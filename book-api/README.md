book-api
========

A Symfony project created on June 10, 2016, 11:20 am.

# Testing step

1. Install [Composer](https://getcomposer.org/)
2. Run `composer install`
3. Update `app/config/parameters.yml` with correct DB connection
4. Run `php app/console faker:populate` to populate test data
5. Run `php app/console server:start` to start dev server
6. Go to [http://localhost:8000/api/books.html?min_date=2014-12-26&max_date=2016-12-31&min_rate=1.23](http://localhost:8000/api/books.html?min_date=2014-12-26&max_date=2016-12-31&min_rate=1.23) to check HTML response
7. Go to [http://localhost:8000/api/books.xml?min_date=2014-12-26&max_date=2016-12-31&min_rate=1.23](http://localhost:8000/api/books.xml?min_date=2014-12-26&max_date=2016-12-31&min_rate=1.23) to check XML response
8. Go to [http://localhost:8000/api/books.json?min_date=2014-12-26&max_date=2016-12-31&min_rate=1.23](http://localhost:8000/api/books.json?min_date=2014-12-26&max_date=2016-12-31&min_rate=1.23) to check JSON response
9. Go to [http://localhost:8000/ws/BookApi](http://localhost:8000/ws/BookApi) to check WSDL
10. Use SOAP client such as [SOAPUI](https://www.soapui.org/) to test the SOAP API. Sample request:

```xml
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://localhost:8000/ws/BookApi/1.0/">
   <soapenv:Header/>
   <soapenv:Body>
      <ns:getBooks>
         <minDate>2016-01-01</minDate>
         <maxDate>2016-02-02</maxDate>
         <minRate>1</minRate>
      </ns:getBooks>
   </soapenv:Body>
</soapenv:Envelope>
```

Sample response

```xml
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost:8000/ws/BookApi/1.0/">
   <SOAP-ENV:Body>
      <ns1:getBooksResponse>
         <return>
            <item>
               <id>32</id>
               <isbn>9791407992470</isbn>
               <author>Darryl Walter</author>
               <title>Possimus qui deleniti possimus ex quod ea minus.</title>
               <publishDate>
                  <date>2014-12-26 00:00:00.000000</date>
                  <timezone_type>3</timezone_type>
                  <timezone>Asia/Ho_Chi_Minh</timezone>
               </publishDate>
               <rating>7.90</rating>
            </item>
            <item>
               <id>44</id>
               <isbn>9799582381874</isbn>
               <author>Torrey Grant</author>
               <title>Voluptatem quod illo ea consequatur est.</title>
               <publishDate>
                  <date>2015-08-20 00:00:00.000000</date>
                  <timezone_type>3</timezone_type>
                  <timezone>Asia/Ho_Chi_Minh</timezone>
               </publishDate>
               <rating>9.35</rating>
            </item>
            <item>
               <id>47</id>
               <isbn>9795619531335</isbn>
               <author>Dr. Ivah Batz Sr.</author>
               <title>Consequuntur at rerum odit eaque ea voluptatem.</title>
               <publishDate>
                  <date>2014-08-26 00:00:00.000000</date>
                  <timezone_type>3</timezone_type>
                  <timezone>Asia/Ho_Chi_Minh</timezone>
               </publishDate>
               <rating>1.00</rating>
            </item>
         </return>
      </ns1:getBooksResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```
