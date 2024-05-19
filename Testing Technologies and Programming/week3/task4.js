// Create class for User
class User {
    // Class's constructor
    constructor() {
      this._numberOfArticles = 0;
    }

    //Getter for number of articles
    get numberOfArticles() {
        this._numberOfArticles = 0;
    }

    //Setter for number of articles
    set numberOfArticles(numberOfArticles) {
        return this._numberOfArticles = this._numberOfArticles;
    }

  }

//Create a new sublcass for Author  
class Author extends User {
    constructor() {
        super();
    }

    calcScores(){
        return this._numberOfArticles * 10 + 20;
    }
}

//Create a new subclass for Editor
class Editor extends User {
    constructor() {
        super();
    }

    calcScores(){
        return this._numberOfArticles * 6 + 15;
    }
}


//Object for author
const author = new Author();
author.numberOfArticles = 8;
console.log("Author's scores: ", author.calcScores());

//Object for Editor
const editor = new Editor();
editor.numberOfArticles = 15;
console.log("Editor's scores: ", editor.calcScores());

  