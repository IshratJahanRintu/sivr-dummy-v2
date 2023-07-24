function highlightCurrentAudio(index) {
    let listItems = document.querySelectorAll('#audioList li');
    for (let i = 0; i < listItems.length; i++) {
        listItems[i].classList.remove('highlight');
    }

    if (index >= 0 && index < listItems.length) {
        listItems[index].classList.add('highlight');
    }
}


function playAudio(url,index){
    console.log(url);
    highlightCurrentAudio(index);
    document.getElementById('audioSource').src = `${url}`;
    document.getElementById('audioPlayer').load();
    document.getElementById('audioPlayer').play();
}
