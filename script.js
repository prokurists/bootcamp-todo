/**
 * 
 * @param {*} event 
 * @param {*} form 
 * @param {function || false} callback() - function parameters (response, form)
 */
function postRequest(event, form, callback = false) {
    event.preventDefault();
    let url = form.getAttribute('action'),
        data = new FormData(form);

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (callback) {
            callback(this.responseText, form)
        }
    };
    xhttp.open("POST", url);

    xhttp.send(data);
}

function getRequest(url, callback = false) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        let response_object = JSON.parse(this.responseText);
        if (response_object.status == true) {
            let data = response_object.data;

            if (callback) {
                callback(data);
            }
        }
    };
    xhttp.open("GET", url);
    xhttp.send();
}

function requestApi(event) {
    event.preventDefault();
    let id = this.getAttribute('data-id');
    //api.php?id=4&page=design
    getRequest('api.php?delete=' + id + '&page=' + PAGE, function (data) {
        console.log(data);

    });
}

function addTask(response, form) {
    let tasks = document.querySelector('#task_list');
    let template = tasks.querySelector('.template');
    let new_task = template.cloneNode(true);
    new_task.classList.remove('template');

    let json = JSON.parse(response);

    if (json.status === true) {
        TASKS[json.id] = json.task;
        form.querySelector('input').value = '';
        new_task.querySelector('.description').textContent = json.task;
        new_task.querySelector('.delete').setAttribute('data-id', json.id);
        console.log(json.task);
        tasks.prepend(new_task);
    }
}