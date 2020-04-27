const express = require('express');
const app = express();

app.get('/', function(req,res) {
    res.send("It's works");
});

const port = 9000;
app.listen(port, function() {
    console.log('Listening on port 9000!')
})