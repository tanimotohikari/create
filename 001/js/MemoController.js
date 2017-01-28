function MemoController () {
  var self = this;
  self.memoList = [];

  self.createText = function () {
    var now = new Date();
    var year = now.getFullYear();
    var mon = now.getMonth()+1; //１を足すこと
    var day = now.getDate();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();

    var nowTime = year + "年" + mon + "月" + day + "日" + hour + "時" + min + "分" + sec + "秒"; 
    if(self.textTitle && self.textContents){
      self.memoList.push({title: self.textTitle, contents: self.textContents, time: nowTime});
      self.textTitle = '';
      self.textContents = '';
    }
  };
}