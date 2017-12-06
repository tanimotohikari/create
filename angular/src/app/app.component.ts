import { Component } from '@angular/core';

@Component({
  selector: 'my-app',
  template: `
    <h1>Hello {{name}}</h1>
    <h2>text</h2>
  `,
  styles: [`
    h1 {
      color: red;
    }
    h2 {
      color: blue;
    }
  `]
})
export class AppComponent  { 
  name = 'First Angular Application'; 
}
