var container = document.querySelector('.menu-container');

database.forEach(exercise => {
    var title = document.createElement('p');
    title.innerText = exercise.title;

    var element = document.createElement('div');
    element.classList.add('item');
    element.addEventListener('click', function (e) {
        window.location = exercise.url;
    }, false);
    element.appendChild(title);

    container.appendChild(element);
});