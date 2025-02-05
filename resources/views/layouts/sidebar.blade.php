<div class="col-md-3 sidebar p-3 bg-light" style="min-height: 600px;">
    <h4>Merchant Dashboard</h4>
    <a href="{{ route('store.list') }}" class="tab-link {{ request()->routeIs('store.list') ? 'active' : '' }}">Store List</a>
    <a href="{{ route('store.create') }}" class="tab-link {{ request()->routeIs('store.create') ? 'active' : '' }}">Create Store</a>
</div>

<style>
    .tab-link {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: black;
        background: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .tab-link:hover{
        background: gray;
        color: #f8f9fa;
    }
    .tab-link.active {
        background: #007bff;
        color: white;
    }
</style>
