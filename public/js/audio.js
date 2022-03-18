var audios = document.getElementsByClassName('musique')

var son = document.getElementById('5')

son.onplay = function (){
    alert("song is playing")
}

audios.forEach(item=>{
    item.onplay = function (){
        alert("song played");
    }
})

function pauseOtherSongs(idToPlay){
    audios.forEach(item=>{
        if(item.id != idToPlay){
            item.pause();
        }
    })
}