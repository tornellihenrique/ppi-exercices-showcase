var container = document.querySelector('.menu-container');

database.forEach(exercise => {
    var title = document.createElement('p');
    title.innerText = exercise.title;

    var exModule = document.createElement('span');
    exModule.innerText = exercise.module;
    switch (exercise.module) {
        case 1:
            exModule.style.backgroundColor = 'green';
            break;
        case 2:
            exModule.style.backgroundColor = 'orange';
            break;
        case 3:
            exModule.style.backgroundColor = 'red';
            break;
        case 4:
            exModule.style.backgroundColor = 'blue';
            break;
    }

    var element = document.createElement('div');
    element.classList.add('item');
    element.addEventListener('click', function (e) {
        window.location = exercise.url;
    }, false);
    element.appendChild(exModule);
    element.appendChild(title);

    container.appendChild(element);
});