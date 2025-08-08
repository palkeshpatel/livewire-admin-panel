1.please check you get file as per bellow stucture
you need to ste our designe from public/backend desgined pages
resources/
├── views/
│ ├── admin/
│ │ ├── layouts/
│ │ │ ├── app.blade.php # Main admin layout (extends header/footer/sidebar)
│ │ │ ├── header.blade.php
│ │ │ ├── footer.blade.php
│ │ │ ├── sidebar.blade.php
│ │ ├── dashboard.blade.php # Admin dashboard view
│ │ ├── users/
│ │ │ ├── index.blade.php # Admin > Users list
│ │ │ ├── create.blade.php
│ │ │ └── edit.blade.php
│ │ ├── products/
│ │ │ ├── index.blade.php
│ │ │ ├── create.blade.php
│ │ │ └── edit.blade.php
│ │ └── orders/
│ │ ├── index.blade.php
│ │ └── show.blade.php
│
├── layouts/
│ └── messages.blade.php # Global flash/success/error messages
