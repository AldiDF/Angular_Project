var currentPage = window.location.pathname;

if (currentPage.includes("admin")){
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
                url: "../databases/liveSearch.php",
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
                        $.each(limitedResults, function(index, item){
                            if (item["foto"] == ""){
                                var direktoriFoto = "../assets/default.jpg";
                            } else {
                                var direktoriFoto = `../databases/profile/${item["foto"]}`;
                            }
                            if (item.judul){
                                html += `
                                <li class="../list-search">
                                    <a href="detail.php?lagu=${item["lagu"]}" class="link-search">
                                        <img src="../databases/thumbnail/${item["thumbnail"]}" alt="gambar-konten" class="search-thumbnail">
                                        <p>${item["judul"]}</p>
                                    </a>
                                </li>`;
    
                            } else {
                                html += `
                                <li class="list-search">
                                    <a href="../profile.php?user=${item["username"]}" class="link-search">
                                        <img src='${direktoriFoto}' alt='profile' class='nav-profile-picture'>
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

} else {
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
                        $.each(limitedResults, function(index, item){
                            if (item["foto"] == ""){
                                var direktoriFoto = "assets/default.jpg";
                            } else {
                                var direktoriFoto = `databases/profile/${item["foto"]}`;
                            }

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
                                        <img src='${direktoriFoto}' alt='profile' class='nav-profile-picture'>
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
}
