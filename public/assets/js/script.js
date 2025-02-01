var new_event_count = 0;

// create new inputs to new events
document.querySelector('#btn_add_event').addEventListener('click', () => {
    new_event_count += 1;
    // create new inputs
    let new_event = document.createElement('div');
    new_event.classList.add('mb-3', 'row');
    new_event.innerHTML = `<p class="form-label">New event</p>
                           <div class="col-12 col-sm-8 mb-3">
                                <input type="text" name="new_event_name_${new_event_count}" class="form-control" placeholder="Event name" required>
                           </div>
                           <div class="col-12 col-sm-4">
                                <input type="number" name="new_event_date_${new_event_count}" class="form-control" min="1" max="31" placeholder="Event date" required>
                           </div>`;
    document.querySelector('#events').appendChild(new_event);
}); 