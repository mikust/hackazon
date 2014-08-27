<script>
    $(function() {
        var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
        while (m = re.exec(queryString)) {
            queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
        }
		function remove(arr, item) {
			for(var i = arr.length; i--;) {
				if(arr[i] == item) {
				console.log(arr[i])
					arr.splice(i, 1);
				}
			}
		}
        $("#filter-block [data-filter=brands]").on("click", function(e) {
            queryParameters['brands'] = $(this).find("input[type=hidden]").val();
			if($(this).parent().hasClass("active")) {
				queryParameters['brands'] = "";
			}
            location.search = $.param(queryParameters);
			e.preventDefault();
        });

        $("#filter-block [data-filter=price]").on("click", function(e) {
            queryParameters['price'] = $(this).find("input[type=hidden]").val();
			if($(this).parent().hasClass("active")) {
				queryParameters['price'] = "";
			}
            location.search = $.param(queryParameters);
        });

        $("#filter-block [data-filter=quality]").on("click", function(e) {
            queryParameters['quality'] = $(this).find("input[type=hidden]").val();
			if($(this).parent().hasClass("active")) {
				queryParameters['quality'] = "";
			}
            location.search = $.param(queryParameters);
        });
		$("#filter-block input[type=reset]").on("click", function(e) {
			queryParameters['quality'] = "";
            queryParameters['price'] = "";
            queryParameters['brands'] = "";
			location.search = $.param(queryParameters);
        });
		
    });
</script>
<div class="row">
    <div class="col-xs-12 col-sm-3">
        <br/>
        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="col-xs-12">
                <div class="well well-small" id="filter-block">
                    <form action="/search" name="filter-block">
						<ul class="nav nav-list">
							<li class="nav-header">Brands</li>
							<?php
							foreach ($filterFabric->getFilter('Brand')->getVariants() as $id => $name) {
								//$isChecked = in_array($id, $filterFabric->getFilter('brandFilter')->getValue()) ? 'checked' : '';
                        		$isChecked = $brand == $id ? 'active' : '';
								?>
								<li class="<?=$isChecked?>">
									<a href="#" data-filter="brands">
										<span class="glyphicon glyphicon-ok"></span>&nbsp;<?= $name ?>
										<input type="hidden" data-type="filter" name="<?= $filterFabric->getFilter('Brand')->getFieldName() ?>[]" value="<?= $id ?>" data-type="filter-param">
									</a>
								</li>
								<?php
							}
							?>
							<hr>
							<li class="nav-header">Price</li>
							<?php
							foreach ($filterFabric->getFilter('Price')->getVariants() as $id => $name) {
								//$isChecked = $filterFabric->getFilter('priceFilter')->getValue() == $id ? 'checked' : '';
                        		$isChecked = $price == $id ? 'active' : '';
								$elemId = 'price-' . $id;
								?>
								<li class="<?=$isChecked?>">
									<a href="#" data-filter="price">
										<span class="glyphicon glyphicon-ok"></span>&nbsp;<?= $filterFabric->getFilter('Price')->getLabel($id) ?>
										<input type="hidden" name="<?= $filterFabric->getFilter('Price')->getFieldName() ?>" id="<?= $elemId ?>" value="<?= $id ?>" <?= $isChecked ?> data-type="filter-param"   />
									</a>
								</li>
								<?php
							}
							?>
							<hr>
							<li class="nav-header">Quality</li>
							<?php
							foreach ($filterFabric->getFilter('Quality')->getVariants() as $id => $name) {
								//$isChecked = $filterFabric->getFilter('qualityFilter')->getValue() == $id ? 'checked' : '';
                        		$isChecked = $quality == $id ? 'active' : '';
								$elemId = 'quality-' . $id;
								?>
								<li class="<?=$isChecked?>">
									<a href="#" data-filter="quality">
										<span class="glyphicon glyphicon-ok"></span>&nbsp;<?= $name ?>
										<input type="hidden" name="<?= $filterFabric->getFilter('Quality')->getFieldName() ?>" id="<?= $elemId ?>" value="<?= $id ?>" <?= $isChecked ?> data-type="filter-param"  />
									</a>
								</li>
								<?php
							}
							?>
						</ul>
						<br>
						<div class="clearfix">
						<input type="reset" value="Reset" class="btn btn-warning pull-right" />
						</div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END CONTENT ITEM -->
        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="hidden-xs col-sm-12">
                <div class="slider-wrapper theme-light">
                    <div class="ribbon"></div>
                    <div id="slider2" class="nivoslider">
                        <img src="/images/banner_01-v3.jpg" alt=""
                             title="This is an example of an optional long caption text"/>
                        <img src="/images/banner_02-v3.jpg" alt="" title=""/>
                        <img src="/images/banner_03-v3.jpg" alt="" title=""/>
                        <img src="/images/banner_04-v3.jpg" alt="" title="Another caption"/>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- END CONTENT ITEM -->
    <div class="col-xs-12 col-sm-9">
        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <h2><?= $_($pageTitle, 'searchString'); ?></h2>
            </div>
        </div>
        <!-- END CONTENT ITEM -->
      <?php if (count($pager->current_items()) > 0) { 
      $products_count = count($pager->current_items());
      ?>
      <div class="row product-list-inline-small">
        
      <?php foreach($pager->current_items() as $item):?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail">
            <a href="/product/view/<?= $item->productID ?>"><img src="/products_pictures/<?= $item->thumbnail ?>" alt="">
            </a>
            <div class="caption">
              <a href="/product/view/"
                <?= $item->productID ?>"><?= $item->name ?>
              </a>
              <p>
                <span class="label label-info price pull-right">
                  $<?= $item->Price ?>
                </span>
              </p>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <!-- Render pager links -->
      <ul class="pagination pull-right">
        <?php for($i=1; $i<=$pager->num_pages; $i++): ?>
	<li>
          <a href="<?php echo $pager->url($i);?>"><?php echo $i;?>
          </a>
        </li>
        <?php endfor;?>
      </ul>
      <?php } else { ?>
      <div class="alert alert-info">No products found.</div>
      <?php } ?>
      <!-- OLD -->
      <div class="hide">
      <?php
        if (count($products) > 0) {
            $rows = count($products) % 4 == 0 ? count($products) / 4 : ceil(count($products) / 4);
            for ($r = 0; $r < $rows; $r++) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row product-list-inline-small">
                            <?php
                            $count = count($products) < 4 ? count($products) : 4;
                            for ($cnt = 0; $cnt < $count; $cnt++) {
                                $item = array_shift($products);
                                ?>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="thumbnail">
                                        <a href="/product/view/<?= $item->productID ?>"><img src="/products_pictures/<?= $item->thumbnail ?>" alt=""></a>

                                        <div class="caption">
                                            <a href="/product/view/<?= $item->productID ?>"><?= $item->name ?></a>
                                          <p>
                                            <? //$item->getAnnotation(40) ?>
                                            <span class="label label-info price pull-right">$<?= $item->Price ?></span>
                                          </p>
                                        </div>
                                    </div>
                                </div>
        <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-info">No products found.</div>
        <?php } ?>        <!-- END CONTENT ITEM -->
      <!-- /OLD -->
      </div>
    </div>
</div>
