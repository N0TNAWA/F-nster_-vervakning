
fetch('windows.php')

.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok ' + response.statusText);
    }
    return response.json();
})

.then(items => {
    if (!items || items.length === 0) {
        throw new Error('List is null or empty');
    }

    items.forEach(item => {

        const list = document.getElementById(`${item.Floor}`);

        const object = document.createElement("div");
        object.setAttribute("class", `info_container`);
        object.setAttribute("id", `pinId_${item.pinId}`);
        list.appendChild(object);

        const info = document.createElement("li");
        info.setAttribute("id", `output_${item.ID}`);
    
        object.appendChild(info);

        const info_floor = document.createElement("a");
        info_floor.setAttribute("id", `floor_${item.ID}`);
        info_floor.textContent = `Floor: ${item.Floor}`;
        info.appendChild(info_floor);

        const info_classroom = document.createElement("a");
        info_classroom.setAttribute("id", `classroom_${item.ID}`);
        info_classroom.textContent = `Classroom: ${item.Classroom}`;
        info.appendChild(info_classroom);

        const info_time = document.createElement("a");
        info_time.setAttribute("id", `time_${item.ID}`);
        info_time.textContent = `Time: ${item.Time}`;
        info.appendChild(info_time);

        const state = document.createElement("a");
        state.setAttribute("id", `state_${item.pinId}`);
        info.appendChild(state);
        if (item.sensorState !== null) {
            if(item.sensorState == "1") {
                state.textContent = `State: Open`
            } else {
                state.textContent = `State: Closed`
            }
        } else {
            state.textContent = `State: Not defined`
        }
    });
})

.catch(error => {
    console.error('Error fetching data:', error);
});

const checkEvent = new EventSource('check.php');

checkEvent.onmessage = function(event) {
    const data = JSON.parse(event.data);
    console.log(event.data);

    var element = document.getElementById("state_" + data.pinId)
    if(data.sensorState == 1) {
        element.textContent = `State: Open`;
        element.setAttribute("class", "red");
    } else {
        element.textContent = `State: Closed`;
        element.setAttribute("class", "green");
    }
};

checkEvent.onerror = function(event) {
    console.error(event);
};

const wifiEvent = new EventSource('db.php');

wifiEvent.onmessage = function(event) {
    console.log(event);
}

wifiEvent.onerror = function(event) {
    console.error(event);
}


setTimeout(() => {
    location.reload();
}, 3600000);