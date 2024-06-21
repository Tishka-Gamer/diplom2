async function postDataJS(route, data, _token) {
    let response = await fetch(route,
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
            },
            body: JSON.stringify({data, _token})
        });
    return await response.json();
}

async function postDataForm(route, data, _token) {
    let response = await fetch(route,
        {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': _token,
            },
            body: data
        });
    return await response.json();
}
