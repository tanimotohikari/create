function MemoController() {
  var self = this;
  self.memoLists = [];
  self.memoDetail = [];
  memoId = 0;

  self.createText = function() {
    var now = new Date();
    var year = now.getFullYear();
    var mon = now.getMonth()+1; //１を足すこと
    var day = now.getDate();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();
    var nowTime = year + "年" + mon + "月" + day + "日" + hour + "時" + min + "分" + sec + "秒"; 
    if(self.textTitle && self.textContents){
      self.memoLists.push({id: memoId, title: self.textTitle, contents: self.textContents, time: nowTime});
      var jsonTodoData =[JSON.stringify(self.memoLists)];
      localStorage.setItem('memoLists', jsonTodoData);
      self.textTitle = '';
      self.textContents = '';
      memoId++;
    }
  };

  //localStorageに保存されたmemoを表示する
  function showMemoList() {
    var memoLists = localStorage.getItem('memoLists');
    if(memoLists) {
      memoLists = JSON.parse(memoLists);
      for(var i=0, len=memoLists.length; i<len; i++) {
        self.memoLists.push({id: i, title: memoLists[i].title, contents: memoLists[i].contents, time: memoLists[i].time});
      }
    } else {
      memoLists = [];
    }

    memoId = memoLists.length;

  }

  showMemoList();

  self.showDetail = function(memoId) {
    self.memoDetail = [];
    $('.sidein-content').animate({left: 0},200);
    for(var i=0, len=self.memoLists.length; i<len; i++) {
      if(memoId == self.memoLists[i].id) {
        self.memoDetail.push({title: self.memoLists[i].title, contents: self.memoLists[i].contents, time: self.memoLists[i].time});
      }
    }
  }
}