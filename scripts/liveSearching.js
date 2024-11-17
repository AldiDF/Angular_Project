$(document).ready(function(){
    const liveSearch = $(".live-search-result");

    $("#nav-search-bar input").keyup(function(){
        live_search($(this).val());

        if ($(this).val() == ""){
            liveSearch.hide();
        } else {
            liveSearch.show();
        }


    });

    $("#nav-search-bar input").blur(function(){
        liveSearch.hide();
    });

    $(".live-search-result .search-result").mousedown(function(e){
        e.preventDefault();
    })

    function live_search(keyword){
        $.ajax({
            url: "databases/liveSearch.php",
            type: "GET",
            data: {
                action: "navbar-search",
                keyword: keyword,
                search: "live"
            },
            dataType: "json",
            success: function(result){
                console.log(result);

                divSearchResult = $(".live-search-result .search-result");

                let html = `<li class="list-search"></li>`;

                if (result.length > 0){
                    let limitedResults = result.slice(0, 4);
                    $.each(result, function(index, item){
                        if (item.judul){
                            html += `
                            <li class="list-search">
                                <a href="detail.php?lagu=${item["lagu"]}" class="link-search">
                                    <img src="databases/thumbnail/${item["thumbnail"]}" alt="gambar-konten" class="search-thumbnail">
                                    <p>${item["judul"]}</p>
                                </a>
                            </li>`;

                        } else {
                            html += `
                            <li class="list-search">
                                <a href="profile.php?user=${item["username"]}" class="link-search">
                                    <i class="fa-regular fa-circle-user" style="font-size: 36px"></i>
                                    <p>${item["username"]}</p>
                                </a>
                            </li>`;
                        }
                    });

                } else {
                    html = `<li class="link-search" style="color: red; text-align: center;"><p>Tidak ada hasil</p></li>`;
                }
                divSearchResult.html(html);
            }
        });
    }
});