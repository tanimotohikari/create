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
    console.log(memoId);
    self.memoDetail = [];
    $('.sidein-content').animate({left: 0},200);
    for(var i=0, len=self.memoLists.length; i<len; i++) {
      if(memoId == self.memoLists[i].id) {
        self.memoDetail.push({id: self.memoLists[i].id, title: self.memoLists[i].title, contents: self.memoLists[i].contents, time: self.memoLists[i].time});
      }
    }
  }

  self.upDate = function(updateData) {
    var updateLists = [];
    for(var i=0, len=self.memoLists.length; i<len; i++) {
      updateLists.push({id: self.memoLists[i].id, title: self.memoLists[i].title, contents: self.memoLists[i].contents, time: self.memoLists[i].time});
    }
    self.memoLists = [];
    for(var i=0, len=updateLists.length; i<len; i++) {
      if(updateData.id == updateLists[i].id) {
        self.memoLists.push({id: updateData.id, title: updateData.title, contents: updateData.contents, time: updateData.time});
      } else {
        self.memoLists.push({id: updateLists[i].id, title: updateLists[i].title, contents: updateLists[i].contents, time: updateLists[i].time});
      }
    }
    var jsonTodoData =[JSON.stringify(self.memoLists)];
    localStorage.setItem('memoLists', jsonTodoData);
    $('.sidein-content').animate({left: -50 + '%'},200);
  }
}