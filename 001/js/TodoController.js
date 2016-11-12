function TodoController() {
  var self = this;

  self.todos = [];
  self.completions = [];

  self.create = function() {
    var now = new Date();
    var year = now.getFullYear();
    var mon = now.getMonth()+1; //１を足すこと
    var day = now.getDate();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();

    var nowTime = year + '年' + mon + '月' + day + '日' + hour + '時'+ min + '分' + sec + '秒'; 

    if (self.newTodo) {
      self.todos.push({title: self.newTodo, done: false, time: nowTime});
      var jsonTodoData =[JSON.stringify(self.todos)];
      localStorage.setItem('todos', jsonTodoData);
      self.newTodo = '';
    }
  };

  function showList() {
    var todos = localStorage.getItem('todos');
    if(todos) {
      todos = JSON.parse(todos);
      for(var i=0, len=todos.length; i<len; i++) {
        self.todos.push({title: todos[i].title, done: todos[i].done, time: todos[i].time});
      }
    } else {
      todos = [];
    }    
  }

  showList();

  self.archive = function() {
    var currentTodo = self.todos;
    self.todos = [];
    angular.forEach(currentTodo, function (todo) {
      if (!todo.done) {
        self.todos.push(todo);
      } else {
        self.completions.push(todo);
      }
    });
  };


  // self.check = function(done) {
  //   console.log(done);
  //   currentTodo = self.todos;
  //   self.todos = [];
  //   angular.forEach(currentTodo, function(todo) {
  //     self.completions.push();
  //     var jsonTodoData =[JSON.stringify(self.completions)];
  //     localStorage.setItem('complete', jsonTodoData);
  //   });
  // };

  
}