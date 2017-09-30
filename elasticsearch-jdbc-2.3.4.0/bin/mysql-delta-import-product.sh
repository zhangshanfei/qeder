#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
bin=${DIR}/../bin
lib=${DIR}/../lib

echo '
{
    "type" : "jdbc",
    "jdbc" : {
        "url" : "jdbc:mysql://localhost:3306/qedertek",
        "schedule" : "0 0-59 0-23 ? * *",
        "user" : "root",
        "password" : "Century_ct@123",
        "sql" : [{
                "statement": "select productid,title,productid as _id from qe_product where updatetime > unix_timestamp(?) ",
                "parameter": ["$metrics.lastexecutionstart"]}
            ],
        "index" : "qedertek",
        "type" : "products",
        "metrics": {
            "enabled" : true
        },
        "elasticsearch" : {
             "cluster" : "qedertek-search",
             "host" : "132.148.24.178",
             "port" : 9300 
        }   
    }
}
' | java \
    -cp "${lib}/*" \
    -Dlog4j.configurationFile=${bin}/log4j2.xml \
    org.xbib.tools.Runner \
    org.xbib.tools.JDBCImporter
