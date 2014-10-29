# MyUserRole Package For Laravel 4

Simple authentication and authorization package for L4.

As the Example If here exist the relationship between user role and permission in your application:

User
- access_cp
- comment
- posting

Editor
- inherit All User Permission
- remove_comment
- approve_posting

So with MyUserRole as facade ...

```php
MyUserRole::createRole('User');
MyUserRole::createPermission('access_cp');
MyUserRole::createPermission('comment');
MyUserRole::createPermission('posting');
MyUserRole::assignPermission('access_cp', 'User');
MyUserRole::assignPermission('comment', 'User');
MyUserRole::assignPermission('posting', 'User');

MyUserRole::createRole('Editor');
MyUserRole::roleInherit(MyUserRole::getRole('Editor'), MyUserRole::getRole('User')->id);
MyUserRole::createPermission('remove_comment');
MyUserRole::createPermission('approve_posting');
MyUserRole::assignPermission('remove_comment', 'Editor');
MyUserRole::assignPermission('approve_posting', 'Editor');

// this would be false
echo MyUserRole::checkRolePermission('remove_comment', 'User');
// this would be true
echo MyUserRole::checkRolePermission('access_cp', 'User');
// this would be true
echo MyUserRole::checkRolePermission('access_cp', 'Editor');
```
