@extends('welcome')
@section('konten')

    <!-- Button to open the modal -->
        <button type="button" class="px-8 py-2 font-bold text-center uppercase transition-all bg-transparent border border-fuchsia-500 rounded-lg text-fuchsia-500 hover:bg-fuchsia-500 hover:text-white">
            Import
        </button>

        <!-- Modal -->
        <div id="importModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg max-w-md w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-bold">Import CSV <i class="ml-2 fas fa-upload"></i></h5>
                    <button type="button" class="text-gray-600 hover:text-gray-900" onclick="closeModal()">✕</button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-6">
                    <p class="mb-4">You can browse your computer for a file.</p>

                    <!-- Browse Input -->
                    <input type="file" class="w-full mb-4 p-2 border border-gray-300 rounded-lg focus:border-fuchsia-300">

                    <!-- Terms Checkbox -->
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="acceptTerms" class="w-5 h-5 text-purple-600 border-gray-300 rounded">
                        <label for="acceptTerms" class="ml-2 text-gray-700">I agree the <span class="font-bold text-blue-600">Terms and Conditions</span></label>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end p-4 border-t">
                    <button type="button" class="px-4 py-2 text-gray-700 bg-gray-300 rounded hover:bg-gray-400 mr-2" onclick="closeModal()">Close</button>
                    <button type="button" class="px-4 py-2 text-white bg-gradient-to-r from-purple-700 to-pink-500 rounded hover:from-purple-800 hover:to-pink-600">Upload</button>
                </div>
            </div>
        </div>

        <script>
            // Function to open the modal
            function openModal() {
                document.getElementById('importModal').classList.remove('hidden');
            }

            // Function to close the modal
            function closeModal() {
                document.getElementById('importModal').classList.add('hidden');
            }

            // Add event listener to the button
            document.querySelector('button').addEventListener('click', openModal);
        </script>
@endsection