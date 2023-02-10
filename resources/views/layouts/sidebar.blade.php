<aside class="main-sidebar" id="sidebar-wrapper">

    <section class="sidebar">
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">
            @include('layouts.menu')
        </ul>
    </section>
</aside>