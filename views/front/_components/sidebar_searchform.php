<?=form_open($shop_url . 'search', 'method="GET" class="search-form"')?>
<div class="input-group">
    <input type="text" value="<?=$this->input->get('s')?>" class="form-control" placeholder="Search All Products" name="s">
    <div class="input-group-btn">
        <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
        </button>
    </div>
</div>
<?=form_close()?>