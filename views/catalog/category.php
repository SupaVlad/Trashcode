<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id']; ?>"
                                           class="<?php if ($categoryId == $categoryItem['id']) echo 'active'; ?>">
                                               <?php echo $categoryItem['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Фильтр</h4>
                    </div>
                    <div class="col-md-12">
                        <form class="form-inline" method="post" style="padding-bottom: 40px" name="filter" id="filter">
                            <div class="form-group" style="width: 100px;">
                                <label for="min_price">Минимальная</label>
                                <input type="number" class="form-control" id="min_price" placeholder="10" value="0">
                            </div>
                            <div class="form-group" style="width: 100px;">
                                <label for="max_price">Максимальная</label>
                                <input type="number" class="form-control" id="max_price" placeholder="20" value="99999">
                            </div>
                            <div class="form-group" style="width: 200px">
                                <div class="col-md-12">
                                    <label for="manufacturer">Производители</label>
                                </div>
                                <?php
                                $result_full = []; $i = 0; $j = 0;
                                $length = count($categoryProducts);
                                    while ($i < $length) {
                                        $ii = $categoryProducts[$i++]; $k = $j;
                                        while ($k-- && $result_full[$k]['brand'] !== $ii['brand']);
                                        if ($k < 0) $result_full[$j++] = $ii;
                                    }
                                ?>
                                <select name="manufacturer" class="form-control" id="manufacturer">
                                    <option value="All">Все</option>
                                    <?php foreach ($result_full as $prod): ?>
                                        <option value="<?=$prod['brand'];?>"><?=$prod['brand'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="max_price">
                                                    От дорогих
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="radio" name="sort_price" value="DESC">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="min_price">
                                                    От дешевых
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="radio" name="sort_price" value="ASC">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <h2 class="title text-center">Последние товары</h2>
                    </div>
                </div>
                <div class="features_items"><!--features_items-->
                    <div id="loader" style="display: none;width: 400px;margin: 0 auto">
                        <img src="../../template/images/loader.gif" alt="">
                    </div>
                    <div class="reload-items">
                        <?php foreach ($categoryProducts as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo Product::getImage($product['id']); ?>" alt=""/>
                                            <h2>$<?php echo $product['price']; ?></h2>
                                            <p>
                                                <a href="/product/<?php echo $product['id']; ?>">
                                                    <?php echo $product['name']; ?>
                                                </a>
                                            </p>
                                            <a href="/cart/add/<?php echo $product['id']; ?>"
                                               class="btn btn-default add-to-cart"
                                               data-id="<?php echo $product['id']; ?>"><i
                                                        class="fa fa-shopping-cart"></i>В корзину</a>
                                        </div>
                                        <?php if ($product['is_new']): ?>
                                            <img src="/template/images/home/new.png" class="new" alt=""/>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!--features_items-->
                <!-- Постраничная навигация -->
                <?php echo $pagination->get(); ?>
            </div>
        </div>
    </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>