<div class="row">
  <div class="mx-auto w-100">
    <form class="text-center col-sm-4 mx-auto">
      <div class="form-group row">
        <div class="col-sm-8 d-block form-select cp">
          <div class="select-custom p-2" data-toggle="tooltip" title="Choose category">
            <select class="custom-select" id="inlineFormCustomSelect">
              <option selected="selected">Category</option>
              <option value="1">Student discounts</option>
              <option value="2">Freebies</option>
              <option value="3">Study material</option>
              <option value="3">Part-time work</option>
            </select>
            <div class="row m-0">
              <div class="col-10 p-0 mr-2 selected-option"></div>
              <div class="col p-0 text-center caret"><i class="fas fa-caret-down"></i></div>
            </div>
          </div>
          <div class="select-items select-hide"></div>
        </div>
        <div class="col-4 mx-auto">
          <input type="submit" class="btn btn-block p-2" value="Search">
          
        </div>
      </div>
    </form>
    <div class="d-flex col">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/public/images/download.jpeg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $(".select-custom").tooltip({
    trigger: "hover"
  });
  $(".selected-option").html($(".custom-select").find("option:selected").html());
  $(this).find("option").each(function () {
    $(".select-items").append("<div class='p-2'>"+$(this).html()+"</div>");
  })
  $(".select-items div:first-child").addClass("selected disabled");

  $(".select-custom").click(function (e) { 
    $(this).find(".fas").toggleClass("fa-caret-down fa-caret-up");
    $(".select-items").toggleClass("select-hide");
  })
  $(".select-items > div").click(function (e) {
    $(".select-items > div").removeClass("selected")
    $(".select-custom [selected=selected]").removeAttr("selected");
    $(".select-custom option:eq("+$(".select-items > div").index(this)+")").attr("selected","selected");
    $(".selected-option").html($(this).html());
    $(".select-custom").find(".fas").toggleClass("fa-caret-down fa-caret-up");
    $(".select-items").toggleClass("select-hide");
    $(this).addClass("selected");
    
  })
})
</script>