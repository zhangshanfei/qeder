#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
bin=${DIR}/../bin
lib=${DIR}/../lib

echo '
{
    "type" : "jdbc",
    "jdbc" : {
        "url" : "jdbc:mysql://localhost:3306/qedertek",
        "user" : "root",
        "password" : "LGc%ElDtQKI3P2Og",
        "sql" : "select title,productid,productid as _id from qe_product",
        "index" : "qedertek",
        "type" : "products",
        "elasticsearch" : {
             "cluster" : "qedertek-search",
             "host" : "166.62.86.189",
             "port" : 9300 
        }   
    }
}
' | java \
    -cp "${lib}/*" \
    -Dlog4j.configurationFile=${bin}/log4j2.xml \
    org.xbib.tools.Runner \
    org.xbib.tools.JDBCImporter
