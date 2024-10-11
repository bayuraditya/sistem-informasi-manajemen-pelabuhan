index operator <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input class="dropdown-item" type="submit" value="Logout">
                                </form>