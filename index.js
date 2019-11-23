"use strict"

import axios from "axios";
import redux from "redux";
import react from "react";

var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: ""
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});
var store = (deliverables) => 
{

};