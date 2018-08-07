document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("#addTagForm").addEventListener("submit", function (e) {
        e.preventDefault();
        console.log("Waiting for response");
        let input = document.querySelector("#newTag");
        if(input && input.value != null){
            const fD = new FormData();
            fD.append('title', input.value);
            fetch("/api/tag/create", {
                method: 'post',
                body: fD
            })
            .then(res => res.json())
            .then(res => {
                console.log("Response gain", res);
                addNewOption(res);
            }).catch(e => {
                console.log(e);
            });
        }
    })
});

function addNewOption(tag) {
    let select = document.querySelector("#song_tags");
    let input = document.querySelector("#newTag");
    if(tag.type === 'ok'){
        console.log("Response gain", tag.message);
        let option = document.createElement("option");
        option.value = tag.id;
        option.selected = "selected";
        option.innerText = tag.title;
        select.appendChild(option);
        input.value = "";
    }
}