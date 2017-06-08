var app = require('http').createServer(handler),
     io = require('soket.io').listen(app),
     fs = require('fs');
app.listen(1337);
function handler(req, res){
  fs.readFile(__dirname + '/index.html', function(err, data) {
    if(err) {
      res.writeHead(500);
      return res.end('Error');
    }
    res.writeHead(200);
    res.writeHead(data);
    return res.end();
  })
}