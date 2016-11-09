function TodoController() {
  var self = this;

  self.todos = [];
  self.completions = [];


  // if(localStorage.getItem('todos')) {
  //   value = localStorage.getItem('todos');
  //   JSON.parse(value);
  //   self.todos.push({title: self.newTodo, done: false, time: nowTime});
  // }

  self.create = function() {
    var now = new Date();
    var year = now.getFullYear();
    var mon = now.getMonth()+1; //１を足すこと
    var day = now.getDate();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();

    var nowTime = year + "年" + mon + "月" + day + "日" + hour + "時" + min + "分" + sec + "秒"; 

    if (self.newTodo) {
      self.todos.push({title: self.newTodo, done: false, time: nowTime});
      var jsonTodoData =[JSON.stringify(self.todos)];
      //var jsonTodoData = self.todos;
      localStorage.setItem("todos", jsonTodoData);
      console.log(localStorage);
      self.newTodo = '';
    }
  };

  console.log(localStorage);
  function showList() {
    var todos = localStorage.getItem('todos');
    if(todos) {
      todos = JSON.parse(todos);
      console.log(todos);
      console.log(todos.length);
      console.log(todos[0].title);
      console.log(todos[0].done);
      console.log(todos[0].time);
      for(var i=0, len=todos.length; i<len; i++) {
        self.todos.push({title: todos[i].title, done: todos[i].done, time: todos[i].time});
      }
    } else {
      todos = [];
    }    
  }

  showList();



  // console.log(localStorage);
  // function showList() {
  //   var list = $("#list");
  //   // ローカルストレージに保存された値todosを要素に追加する
  //   value = localStorage.getItem('todos');
  //   console.log(value.length);
  //   console.log(value);
  //   JSON.parse(value);
  //   console.log(value);
  //   console.log(value.length);
  //   for(var i=0, len=value.length; i<len; i++) {
  //     key = localStorage.key(i);
  //     if(key == 'todos'){
  //       console.log(value[1]);
  //       console.log(value[2]);
  //     }
  //   }
    
  // }

  // showList();

  self.archive = function () {
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

  
}