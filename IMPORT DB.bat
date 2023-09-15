@echo off
curl -X POST -H 'Content-Type: text/csv' -d http://127.0.0.1/import.csv http://127.0.0.1:8000/api/employee