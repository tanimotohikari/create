function TodoController() {
  var self = this;

  self.todos = [];
  self.completions = [];
  self.deleted = [];
  index = 0;

  //新しいtodoの追加
  self.create = function() {
    var now = new Date();
    var year = now.getFullYear();
    var mon = now.getMonth()+1;
    var day = now.getDate();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();

    var nowTime = year + '年' + mon + '月' + day + '日' + hour + '時'+ min + '分' + sec + '秒'; 

    if (self.newTodo) {
      self.todos.push({id: index, title: self.newTodo, done: false, time: nowTime});
      var jsonTodoData =[JSON.stringify(self.todos)];
      localStorage.setItem('todos', jsonTodoData);
      self.newTodo = '';
      index++;
    }
  };

  //localStorageに保存されたtodoを表示する
  function showList() {
    var todos = localStorage.getItem('todos');
    var completions = localStorage.getItem('completions');
    if(todos || completions) {
      todos = JSON.parse(todos);
      for(var i=0, len=todos.length; i<len; i++) {
        self.todos.push({id: i, title: todos[i].title, done: todos[i].done, time: todos[i].time});
      }
    } else {
      todos = [];
    }

    index = todos.length;

    if(completions) {
      completions = JSON.parse(completions);
      for(var i=0, len=completions.length; i<len; i++) {
        self.completions.push({id: completions[i].id, title: completions[i].title, done: completions[i].done, time: completions[i].time});
      }
    } else {
      completions = [];
    }
  }

  showList();

  //チェックボックスにチェックを入れると自動的に完了リストにtodoが移動する
  self.check = function() {
    var currentTodo = self.todos;
    self.todos = [];
    angular.forEach(currentTodo, function (todo) {
      if (!todo.done) {
        self.todos.push(todo);
        var jsonTodoData =[JSON.stringify(self.todos)];
        localStorage.setItem('todos', jsonTodoData);
      } else {
        self.completions.push(todo);
        var jsonTodoData =[JSON.stringify(self.completions)];
        localStorage.setItem('completions', jsonTodoData);
      }
    });
  };

  //todoの削除ボタン
  self.delete = function(todoId) {
    var index = todoId;
    var deleted = [];
    console.log(index);
    for(var i=0, len=self.todos.length; i<len; i++) {
      if(index !== self.todos[i].id) {
        deleted.push({id: self.todos[i].id, title: self.todos[i].title, done: self.todos[i].done, time: self.todos[i].time});
      }
    }
    self.todos = deleted;
    var jsonTodoData =[JSON.stringify(self.todos)];
    localStorage.setItem('todos', jsonTodoData);
  }
}