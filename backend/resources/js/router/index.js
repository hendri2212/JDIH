import { createRouter, createWebHistory } from "vue-router";

import Dashboard from '../views/Dashboard'
import News from '../views/News'
import ListNews from '../components/News/ListNews'
import CreateNews from '../components/News/CreateNews'
import UpdateNews from '../components/News/UpdateNews'
import RelatedLink from '../views/RelatedLink'
import ListRelatedLink from '../components/RelatedLink/ListRelatedLink'
import CreateRelatedLink from '../components/RelatedLink/CreateRelatedLink'
import UpdateRelatedLink from '../components/RelatedLink/UpdateRelatedLink'
import Fraction from '../views/Fraction'
import ListFraction from '../components/Fraction/ListFraction'
import CreateFraction from '../components/Fraction/CreateFraction'
import UpdateFraction from '../components/Fraction/UpdateFraction'
import WorkPlan from '../views/WorkPlan'
import ListWorkPlan from '../components/WorkPlan/ListWorkPlan'
import CreateWorkPlan from '../components/WorkPlan/CreateWorkPlan'
import UpdateWorkPlan from '../components/WorkPlan/UpdateWorkPlan'
import ListUser from '../components/User/ListUser'
import CreateUser from '../components/User/CreateUser'
import UpdateUser from '../components/User/UpdateUser'

const routes = [
    {
        path: '/',
        component: Dashboard,
        name: 'Dashboard'
    },
    {
        path: '/news',
        component: News,
        children:[
            {
                path: '',
                component: ListNews,
                name: 'ListNews',
                meta: {
                    breadcrumb : [
                        {
                            is_active:true,
                            link: null,
                            title: "News"
                        }
                    ]
                }
            },
            {
                path: ':id',
                component: UpdateNews,
                name: 'UpdateNews',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/news',
                            title: "Berita"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Update Berita"
                        }
                    ]
                }
            },
            {
                path: 'create',
                component: CreateNews,
                name: 'CreateNews',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/news',
                            title: "Berita"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Tambah Berita"
                        }
                    ]
                }
            }
        ]
    },
    {
        path: '/related-link',
        component: RelatedLink,
        children:[
            {
                path: '',
                component: ListRelatedLink,
                name: 'ListRelatedLink',
                meta: {
                    breadcrumb : [
                        {
                            is_active:true,
                            link: null,
                            title: "Link Terkait"
                        }
                    ]
                }
            },
            {
                path: ':id',
                component: UpdateRelatedLink,
                name: 'UpdateRelatedLink',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/related-link',
                            title: "Link Terkait"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Update Link Terkait"
                        }
                    ]
                }
            },
            {
                path: 'create',
                component: CreateRelatedLink,
                name: 'CreateRelatedLink',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/related-link',
                            title: "Link Terkait"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Tambah Link Terkait"
                        }
                    ]
                }
            }
        ]
    },
    {
        path: '/fraction',
        component: Fraction,
        children:[
            {
                path: '',
                component: ListFraction,
                name: 'ListFraction',
                meta: {
                    breadcrumb : [
                        {
                            is_active:true,
                            link: null,
                            title: "Fraksi"
                        }
                    ]
                }
            },
            {
                path: ':id',
                component: UpdateFraction,
                name: 'UpdateFraction',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/fraction',
                            title: "Fraksi"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Update Fraksi"
                        }
                    ]
                }
            },
            {
                path: 'create',
                component: CreateFraction,
                name: 'CreateFraction',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/fraction',
                            title: "Fraksi"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Tambah Fraksi"
                        }
                    ]
                }
            }
        ]
    },
    {
        path: '/work-plan',
        component: WorkPlan,
        children:[
            {
                path: '',
                component: ListWorkPlan,
                name: 'ListWorkPlan',
                meta: {
                    breadcrumb : [
                        {
                            is_active:true,
                            link: null,
                            title: "Program Kerja"
                        }
                    ]
                }
            },
            {
                path: ':id',
                component: UpdateWorkPlan,
                name: 'UpdateWorkPlan',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/work-plan',
                            title: "Program Kerja"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Update Program Kerja"
                        }
                    ]
                }
            },
            {
                path: 'create',
                component: CreateWorkPlan,
                name: 'CreateWorkPlan',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/work-plan',
                            title: "Program Kerja"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Tambah Program Kerja"
                        }
                    ]
                }
            }
        ]
    },
    {
        path: '/user',
        component: WorkPlan,
        children:[
            {
                path: '',
                component: ListUser,
                name: 'ListUser',
                meta: {
                    breadcrumb : [
                        {
                            is_active:true,
                            link: null,
                            title: "User"
                        }
                    ]
                }
            },
            {
                path: ':id',
                component: UpdateUser,
                name: 'UpdateUser',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/user',
                            title: "User"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Update User"
                        }
                    ]
                }
            },
            {
                path: 'create',
                component: CreateUser,
                name: 'CreateUser',
                meta: {
                    breadcrumb : [
                        {
                            is_active:false,
                            link: '/user',
                            title: "User"
                        },
                        {
                            is_active:true,
                            link: null,
                            title: "Tambah User"
                        }
                    ]
                }
            }
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes

})