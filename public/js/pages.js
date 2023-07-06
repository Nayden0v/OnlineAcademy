function assignMenuToRole(event, menu_id) {
    event.preventDefault();
    let role_id = document.getElementById("role").value;
    fetch(assign_menu_route, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf_token
        },
        body: JSON.stringify({
            menu_id: menu_id,
            role_id: role_id
        })
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
  }
    function createMenuItem(event) {
    event.preventDefault();
    let role_id = document.getElementById("role").value;
    let name = document.getElementById("newMenuItem").value;
    let route = document.getElementById("newRoute").value;
    // console.log(route);
    fetch(create_menu_item_route, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf_token
        },
        body: JSON.stringify({
            name: name,
            route: route,
            role_id: role_id
        })
    }).then(response => {
    if(!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            console.log(data.message);
        }
    })
    .catch(error => {
        console.log('Error:', error);
    });
    }
    function removeMenuFromRole(event, menu_id) {
        event.preventDefault();
        let role_id = document.getElementById("role").value;
        fetch(remove_menu_route, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token
            },
            body: JSON.stringify({
                menu_id: menu_id,
                role_id: role_id
            })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
