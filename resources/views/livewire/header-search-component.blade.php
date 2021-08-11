<div class="aa-search-box">
        <form action="">
                  <input type="text" name="" id="" placeholder="Search here ex. 'man' ">
                  <button type="submit"><span class="fa fa-search"></span></button>
                  <div class="wrap-list-cate">
                      <input type="hidden" name="product_cat" value="{{$product_cat}}" id="product_cate">
                      <input type="hidden" name="product_cat_id" value="{{$product_cat_id}}" id="product_cate">
                      <a href="" class="link-control">{{str_split($product_cat,12)[0]}}</a>
                  </div>
                </form>
              </div>