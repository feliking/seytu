export default [
  ...applyRules(['guest'], [
    { path: '', component: require('$comp/auth/AuthWrapper').default, redirect: { name: 'login' }, children:
      [
        { path: '/', name: 'main', component: require('$comp/auth/main/Index').default },
        { path: '/login', name: 'login', component: require('$comp/auth/login/Login').default },
        { path: '/register', name: 'register', component: require('$comp/auth/register/Register').default },
        { path: '/password', component: require('$comp/auth/password/PasswordWrapper').default, children:
          [
            { path: '', name: 'forgot', component: require('$comp/auth/password/password-forgot/PasswordForgot').default },
            { path: 'reset/:token', name: 'reset', component: require('$comp/auth/password/password-reset/PasswordReset').default }
          ]
        }
      ]
    },
  ]),
  ...applyRules(['auth'], [
    { path: '', component: require('$comp/admin/AdminWrapper').default, children:
      [
        { path: '', name: 'index', redirect: { name: 'profile' } },
        { path: 'profile', component: require('$comp/admin/profile/ProfileWrapper').default, children:
          [
            { path: '', name: 'profile', component: require('$comp/admin/profile/Profile').default },
            { path: 'edit', name: 'profile-edit', component: require('$comp/admin/profile/edit/ProfileEdit').default }
          ]
        },
        { path: 'lugares', name: 'lugar', component: require('$comp/admin/lugar/Index').default },
        { path: 'tiendas', name: 'tienda', component: require('$comp/admin/tienda/Index').default },
        { path: 'informaciones', name: 'informacion', component: require('$comp/admin/informacion/Index').default },
      ]
    },
  ]),
  { path: '*', redirect: { name: 'index' } }
]

function applyRules(rules, routes) {
  for (let i in routes) {
    routes[i].meta = routes[i].meta || {}

    if (!routes[i].meta.rules) {
      routes[i].meta.rules = []
    }
    routes[i].meta.rules.unshift(...rules)

    if (routes[i].children) {
      routes[i].children = applyRules(rules, routes[i].children)
    }
  }

  return routes
}
