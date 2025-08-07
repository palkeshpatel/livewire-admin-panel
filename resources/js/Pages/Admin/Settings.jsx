import React from 'react';
import { useForm } from '@inertiajs/react';
import Layout from './Layout';

export default function Settings({ settings = {} }) {
    const { data, setData, post, processing, errors } = useForm({
        site_name: settings.site_name || '',
        site_description: settings.site_description || '',
        contact_email: settings.contact_email || '',
        contact_phone: settings.contact_phone || '',
        address: settings.address || '',
        commission_rate: settings.commission_rate || '',
        currency: settings.currency || 'USD',
        tax_rate: settings.tax_rate || '',
        shipping_cost: settings.shipping_cost || '',
        min_order_amount: settings.min_order_amount || ''
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/admin/settings', {
            onSuccess: () => {
                // Show success message
            }
        });
    };

    return (
        <Layout title="Settings">
            {/* Header */}
            <div className="mb-6">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900">Settings</h1>
                    <p className="mt-1 text-sm text-gray-500">
                        Configure your ecommerce platform settings
                    </p>
                </div>
            </div>

            {/* Settings form */}
            <div className="bg-white shadow rounded-lg">
                <form onSubmit={handleSubmit} className="p-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {/* General Settings */}
                        <div className="space-y-4">
                            <h3 className="text-lg font-medium text-gray-900 border-b pb-2">General Settings</h3>

                            <div>
                                <label htmlFor="site_name" className="block text-sm font-medium text-gray-700">
                                    Site Name
                                </label>
                                <input
                                    type="text"
                                    id="site_name"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.site_name}
                                    onChange={e => setData('site_name', e.target.value)}
                                />
                                {errors.site_name && <div className="text-red-500 text-sm mt-1">{errors.site_name}</div>}
                            </div>

                            <div>
                                <label htmlFor="site_description" className="block text-sm font-medium text-gray-700">
                                    Site Description
                                </label>
                                <textarea
                                    id="site_description"
                                    rows="3"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.site_description}
                                    onChange={e => setData('site_description', e.target.value)}
                                />
                                {errors.site_description && <div className="text-red-500 text-sm mt-1">{errors.site_description}</div>}
                            </div>

                            <div>
                                <label htmlFor="currency" className="block text-sm font-medium text-gray-700">
                                    Currency
                                </label>
                                <select
                                    id="currency"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.currency}
                                    onChange={e => setData('currency', e.target.value)}
                                >
                                    <option value="USD">USD ($)</option>
                                    <option value="EUR">EUR (€)</option>
                                    <option value="GBP">GBP (£)</option>
                                    <option value="INR">INR (₹)</option>
                                </select>
                                {errors.currency && <div className="text-red-500 text-sm mt-1">{errors.currency}</div>}
                            </div>
                        </div>

                        {/* Contact Information */}
                        <div className="space-y-4">
                            <h3 className="text-lg font-medium text-gray-900 border-b pb-2">Contact Information</h3>

                            <div>
                                <label htmlFor="contact_email" className="block text-sm font-medium text-gray-700">
                                    Contact Email
                                </label>
                                <input
                                    type="email"
                                    id="contact_email"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.contact_email}
                                    onChange={e => setData('contact_email', e.target.value)}
                                />
                                {errors.contact_email && <div className="text-red-500 text-sm mt-1">{errors.contact_email}</div>}
                            </div>

                            <div>
                                <label htmlFor="contact_phone" className="block text-sm font-medium text-gray-700">
                                    Contact Phone
                                </label>
                                <input
                                    type="text"
                                    id="contact_phone"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.contact_phone}
                                    onChange={e => setData('contact_phone', e.target.value)}
                                />
                                {errors.contact_phone && <div className="text-red-500 text-sm mt-1">{errors.contact_phone}</div>}
                            </div>

                            <div>
                                <label htmlFor="address" className="block text-sm font-medium text-gray-700">
                                    Address
                                </label>
                                <textarea
                                    id="address"
                                    rows="3"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.address}
                                    onChange={e => setData('address', e.target.value)}
                                />
                                {errors.address && <div className="text-red-500 text-sm mt-1">{errors.address}</div>}
                            </div>
                        </div>

                        {/* Business Settings */}
                        <div className="space-y-4">
                            <h3 className="text-lg font-medium text-gray-900 border-b pb-2">Business Settings</h3>

                            <div>
                                <label htmlFor="commission_rate" className="block text-sm font-medium text-gray-700">
                                    Commission Rate (%)
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    id="commission_rate"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.commission_rate}
                                    onChange={e => setData('commission_rate', e.target.value)}
                                />
                                {errors.commission_rate && <div className="text-red-500 text-sm mt-1">{errors.commission_rate}</div>}
                            </div>

                            <div>
                                <label htmlFor="tax_rate" className="block text-sm font-medium text-gray-700">
                                    Tax Rate (%)
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    id="tax_rate"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.tax_rate}
                                    onChange={e => setData('tax_rate', e.target.value)}
                                />
                                {errors.tax_rate && <div className="text-red-500 text-sm mt-1">{errors.tax_rate}</div>}
                            </div>

                            <div>
                                <label htmlFor="shipping_cost" className="block text-sm font-medium text-gray-700">
                                    Default Shipping Cost
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    id="shipping_cost"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.shipping_cost}
                                    onChange={e => setData('shipping_cost', e.target.value)}
                                />
                                {errors.shipping_cost && <div className="text-red-500 text-sm mt-1">{errors.shipping_cost}</div>}
                            </div>

                            <div>
                                <label htmlFor="min_order_amount" className="block text-sm font-medium text-gray-700">
                                    Minimum Order Amount
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    id="min_order_amount"
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value={data.min_order_amount}
                                    onChange={e => setData('min_order_amount', e.target.value)}
                                />
                                {errors.min_order_amount && <div className="text-red-500 text-sm mt-1">{errors.min_order_amount}</div>}
                            </div>
                        </div>
                    </div>

                    <div className="mt-6 flex justify-end">
                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium disabled:opacity-50"
                        >
                            {processing ? 'Saving...' : 'Save Settings'}
                        </button>
                    </div>
                </form>
            </div>
        </Layout>
    );
}
