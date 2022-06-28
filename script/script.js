window.onload = function() {

    var search = document.getElementById("search")
    var select = document.getElementById("select")
    var nbr_filter = document.getElementById("nbr_filter")

    if (document.getElementById("title")) {

        var title = document.getElementById("title")
        title.onclick = show

    }

    if (document.getElementById("distributor")) {

        var distributor = document.getElementById("distributor")
        distributor.onclick = show

    }

    if (document.getElementById("date_begin")) {

        var date_begin = document.getElementById("date_begin")
        date_begin.onclick = show

    }

    if (document.getElementById("genre")) {

        var genre = document.getElementById("genre")
        genre.onclick = hide

    }
    
    if (document.getElementById("select")) {

        select.hidden = true
    }
    
    function hide() {

        search.hidden = true
        select.hidden = false
    }
    
    function show() {
        
        search.hidden = false
        select.hidden = true
    }


    nbr_filter.onchange = function change() {

        var url = new URLSearchParams(window.location.search)
        url.set('nombre', nbr_filter.value)
        window.location.search = url

    }

}