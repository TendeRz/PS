// First you need to create a connection to the db
var mysql = require('mysql');

var con = mysql.createConnection({
    host: "127.0.0.1",
    user: "root",
    password: "051rdb188",
    database: "dstorage",
    multipleStatements: true
});

con.connect(function(err){
    if(err){
        console.log('Error connecting to Db');
        return;
    }
    console.log('Connection established');
});

module.exports = {
    countryList: function (callback) {
        con.query('SELECT * FROM classcountry ORDER BY 2', function(err,rows){
            if(err) throw err;
            callback(rows);
        })
    },
    setCountries: function (selected, callbackz) {
        var sqlQuerie = "SELECT \
            CONCAT(LPAD(MONTH(TL.tlistfulldate),2,0),'/',LPAD(DAYOFMONTH(TL.tlistfulldate),2,0)) AS Startdate, \
            TIME_FORMAT(TL.tlisttime, '%H:%i') AS Starttime, \
            CC.ClassCountryName AS Country, \
            TL.taskname AS Subject, \
            TS.taskstate AS Status, \
            CS.ClassSysName AS System, \
            TL.tasklistid AS ID, \
            TL.taskid AS Taskid, \
            IF(LENGTH(TLHR.modifyname)>0, TLHR.modifyname, TL.tlistcreatename) as Lastmod, \
            TLHR.tasklisthistoryid, \
            TLHR.rank \
            FROM  classcountry CC, \
            classfuncarea CF, \
            classsystem CS, \
            taskstate TS, \
            procedures P, \
            tasklist TL LEFT JOIN \
            (SELECT \
                tasklisthistoryid, \
                tasklistid, \
                CASE \
                WHEN @prevRank = tasklistid THEN @curRank := @curRank + 1 \
                WHEN @prevRank := tasklistid THEN @curRank := 0 \
                END AS rank, \
                taskid, \
                modifydate, \
                modifyname, \
                modifystate, \
                modifycomment \
                FROM  tasklisthistory, \
                (SELECT @curRank :=0, @prevRank := NULL) r \
                ORDER BY tasklistid, tasklisthistoryid DESC) TLHR ON TL.tasklistid = TLHR.tasklistid \
            WHERE \
            TL.tlistsystem = CS.classsysid \
            AND \
            TL.tlistcountry = CC.classcountryid \
            AND \
            TL.tlistfuncarea = CF.classfuncid \
            AND \
            TL.tliststate = TS.taskstateid \
            AND \
            TL.tlistprocedure = P.procid \
            AND \
            TL.tliststate IN (0, 1, 2, 4, 7) \
            AND \
            CC.classcountryid IN ("+selected+") \
            AND \
            (TLHR.rank = 0 || TLHR.rank IS NULL) \
            ORDER BY TL.tlistfulldate, TL.tlisttime";
        
        var sqlTestQuery = "select * from taskstate";
        
        con.query(sqlQuerie, [],function(err,row){
            if(err) throw err;            
            callbackz(row);                
        })        
    },
    selectTask: function (tasklistid, callback){
        var sqlQuery = "SELECT\
                TL.taskname,\
                CONCAT(TL.tlistfulldate,'  ', TIME_FORMAT(TL.tlisttime, '%H:%i')) as startdate,\
                TS.taskstate as state,\
                CS.ClassSysName as system,\
                CF.classfuncname as funcarea,\
                CC.ClassCountryName as country,\
                P.proctitle as procname,\
                TL.tlistprocedure as listproc,\
                TL.tlistdescription as descript,\
                TL.tlistcreatedate as createdate,\
                TL.tlistcreatename as createname,\
                'Task Created' as note\
                FROM classcountry CC, classfuncarea CF, classsystem CS, taskstate TS, procedures P, tasklist TL LEFT JOIN tasklisthistory TLH ON TL.tasklistid = TLH.tasklistid\
                WHERE\
                    TL.tlistsystem = CS.classsysid\
                    AND\
                    TL.tlistcountry = CC.classcountryid\
                    AND\
                    TL.tlistfuncarea = CF.classfuncid\
                    AND\
                    TL.tliststate = TS.taskstateid\
                    AND\
                    TL.tasklistid = "+tasklistid+"\
                    AND\
                    TL.tlistprocedure = P.procid";
        
        con.query(sqlQuery, function(err,rows){
            if(err) throw err;
            callback(rows);
        })
    },
    selectHistory: function (tasklistid, callback){
        var sqlQuery = "SELECT\
                TLH.modifydate as moddate,\
                TLH.modifyname as modname,\
                CONCAT('Set ', TS.taskstate) as setstate,\
                IF(LENGTH(TLH.modifycomment)>0, TLH.modifycomment, '&nbsp;') as comment\
            FROM\
                tasklisthistory TLH, taskstate TS\
            WHERE\
                TLH.tasklistid = "+tasklistid+"\
                AND\
                TLH.modifystate = TS.taskstateid";
        con.query(sqlQuery, function(err,rows){
            if(err) throw err;
            callback(rows);
        })
    }
}