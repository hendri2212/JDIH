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
    }
]

export default createRouter({
    history: createWebHistory(),
    routes

})