<div class="card">
    <div class="card-header pb-0 text-center">
        <h5>GALLERY</h5>
    </div>
    <div class="gallery my-gallery card-body row" itemscope="" data-pswp-uid="1">
        @foreach($categories as $categorie)
            <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope="">
                <a href="<?= url('gallery/' . $categorie['gallery_category_id'])?>"
                   itemprop="contentUrl"
                   data-size="1600x950">
                    <img class="img-thumbnail" src="../assets/images/folder-icon.png" itemprop="thumbnail"
                         alt="Image description">
                    <span class="text-center"><?= $categorie['gallery_category_name']?></span>
                </a>
            </figure>
        @endforeach
    </div>
</div>
