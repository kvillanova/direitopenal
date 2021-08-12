# Direito Penal

The client for this project was a law school professor. His intentions were to create a class dynamic in the form of a online Quiz.

So my objective here was to create a fun-and-functional Quiz in PHP that is easy to manipulate and create new questions as he wishes.

### ./index
On the main index we have a board with the questions divided by number (the question's no.) and color (the question's difficulty). We can click on the square and access the question. If a question is already answered, the background would have light-turning-off effect.

### /perguntas/
That's were the questions are located. You select an alternative and then the program tells if you are correct or gives you the correct answer. If the question was already answered before, the program just shows you what 

### /admin/
This is where the host can manipulate the questions. You can add/alter/delete questions and alternatives for them. And then it updates a JSON file.

### /reset/
Since it was a prototype, we also have a fast reset script to delete all the session so you can try answering the questions again.
