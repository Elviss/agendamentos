import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';

export default function Dashboard({ auth, services, appointments, flash }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        service_id: '',
        appointment_date: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('appointment.store'), {
            onSuccess: () => reset(),
        });
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Dashboard" />

            {flash.message && (
                <div className="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-lg">
                    {flash.message}
                </div>
            )}

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                {/* Create Appointment Section */}
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6">
                        <h3 className="text-lg font-semibold text-gray-900 mb-4">Book a Service</h3>
                        <form onSubmit={submit}>
                            <div>
                                <label className="block text-sm font-medium text-gray-700">Select Service</label>
                                <select
                                    className="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value={data.service_id}
                                    onChange={(e) => setData('service_id', e.target.value)}
                                    required
                                >
                                    <option value="">Select a service...</option>
                                    {services.map((service) => (
                                        <option key={service.id} value={service.id}>
                                            {service.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.service_id && <div className="text-red-600 text-sm mt-1">{errors.service_id}</div>}
                            </div>

                            <div className="mt-4">
                                <label className="block text-sm font-medium text-gray-700">Date and Time</label>
                                <input
                                    type="datetime-local"
                                    className="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value={data.date_time}
                                    onChange={(e) => setData('date_time', e.target.value)}
                                    required
                                />
                                {errors.date_time && <div className="text-red-600 text-sm mt-1">{errors.appointment_date}</div>}
                            </div>

                            <div className="mt-6">
                                <button
                                    type="submit"
                                    className="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    disabled={processing}
                                >
                                    Book Appointment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {/* Appointments List Section */}
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6">
                        <h3 className="text-lg font-semibold text-gray-900 mb-4">Your Appointments</h3>
                        <div className="space-y-4">
                            {appointments.length === 0 ? (
                                <p className="text-gray-500">No appointments found.</p>
                            ) : (
                                appointments.map((appointment) => (
                                    <div key={appointment.id} className="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                        <div className="flex justify-between items-start">
                                            <div>
                                                <p className="font-medium text-gray-900">
                                                    {services.find(s => s.id === appointment.service_id)?.name || 'Service'}
                                                </p>
                                                <p className="text-sm text-gray-500">
                                                    {new Date(appointment.date_time).toLocaleString()}
                                                </p>
                                            </div>
                                            <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Confirmed
                                            </span>
                                        </div>
                                    </div>
                                ))
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
