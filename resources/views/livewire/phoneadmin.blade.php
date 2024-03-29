<div>
    <div class="pb-4 bg-white dark:bg-gray-900 flex justify-between">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="searchPhone" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
        <button type="button" wire:click="openCreateModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Create
        </button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Department
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Building
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($phonedatas as $phonedata )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $phonedata->namephone }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $phonedata->phonenumber }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $phonedata->department }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $phonedata->role }}
                    </td>
                    <td class="px-6 py-4">
                        {{strtoupper($phonedata->building) }}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="openEditModal({{ $phonedata->id }})" class="font-medium text-white rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-red-300 px-2 py-0.5">Edit</button>
                        <button wire:click="openDeleteModal({{ $phonedata->id }})" class="font-medium text-white rounded-lg bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 px-2 py-0.5">Delete</button>
                    </td>
                </tr>   
                @endforeach 
            </tbody>
        </table>
        <div class="py-2 px-2">
            {{ $phonedatas->onEachSide(3)->links() }}
        </div>
    </div>
    <div>
    {{-- Create modal --}}
        @if($showCreateModal)
        <div class="fixed inset-0 bg-gray-300 opacity-40"  wire:click="hideCreateModal"></div>
        <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" :style="{ 'max-height': '600px' }">
            <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                <div class="text-xl text-gray-800">Create Number</div>
                <button wire:click="hideCreateModal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
       
        <div class="p-4">            
            <form class="max-w-sm mx-auto" wire:submit.prevent="saveData">
                <div class="mb-5">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                <input id="phone" wire:model="phonenumber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Phone number" required />
                @error('phonenumber') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>
                <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input id="name" wire:model="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Your name" required />
                @error('name') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>
                <div class="mb-5">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                <input id="departmrnt"  wire:model="department" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                @error('department') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>   
                <div class="mb-5">
                    <label for="building" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Building</label>
                    <input id="building" wire:model="building" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div> 
                    <div class="mb-5">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <input id="role" wire:model="role" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                @error('role') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror        
                </div>   
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add number</button>
            </form>
        </div>
    </div>
    </div>
    @endif 
    <!-- Edit Modal -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-gray-300 opacity-40"  wire:click="hideEditModal"></div>
        <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" :style="{ 'max-height': '600px' }">
            <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                <div class="text-xl text-gray-800">Edit phone number</div>
                <button wire:click="hideEditModal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
       
        <div class="p-4">            
            <form class="max-w-sm mx-auto" wire:submit.prevent="editData">
                <div class="mb-5">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                <input id="phone" wire:model="ephonenumber" placeholder="{{ $selectedPhoneData['phonenumber'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                @error('ephonenumber') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>
                <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input id="name"  wire:model="enamephone"  placeholder="{{ $selectedPhoneData['namephone'] }}"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"/>
                @error('ename') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>
                <div class="mb-5">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                <input id="department"  wire:model="edepartment" placeholder="{{ $selectedPhoneData['department'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"/>
                @error('edepartment') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>   
                <div class="mb-5">
                    <label for="building" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Building</label>
                    <input id="building"  wire:model="ebuilding" placeholder="{{ $selectedPhoneData['building'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    @error('ebuilding') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                    </div> 
                    <div class="mb-5">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <input id="role" wire:model="erole" placeholder="{{ $selectedPhoneData['role'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"/>
                @error('erole') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                </div>   
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit confirm</button>
            </form>
        </div>
    </div>
    </div>
    @endif

    {{-- Delete Modal --}}
    @if($showDeleteModal)
   <div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
    <div class="fixed inset-0 bg-gray-300 opacity-40" wire:click="hideDeleteModal"></div>
      <div class="w-full max-w-md bg-white shadow-lg rounded-md p-6 relative">
        <svg wire:click="hideDeleteModal" xmlns="http://www.w3.org/2000/svg"
          class="w-3.5 cursor-pointer shrink-0 fill-black hover:fill-red-500 float-right" viewBox="0 0 320.591 320.591">
          <path
            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
            data-original="#000000"></path>
          <path
            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
            data-original="#000000"></path>
        </svg>
        <div class="my-8 text-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 fill-red-500 inline" viewBox="0 0 24 24">
            <path
              d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
              data-original="#000000" />
            <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
              data-original="#000000" />
          </svg>
          <h4 class="text-xl font-semibold mt-6">Are you sure you want to delete it?</h4>
          <p class="text-sm text-gray-500 mt-4">คุณต้องการที่จะลบเบอร์โทร {{ $selectedPhoneData['phonenumber'] }} ใช้หรือไม่</p>
        </div>
        <div class="flex flex-col space-y-2">
          <button wire:click="deleteData" type="button"
            class="px-6 py-2.5 rounded-md text-white text-sm font-semibold border-none outline-none bg-red-500 hover:bg-red-600 active:bg-red-500">Delete</button>
          <button wire:click="hideDeleteModal" type="button"
            class="px-6 py-2.5 rounded-md text-black text-sm font-semibold border-none outline-none bg-gray-200 hover:bg-gray-300 active:bg-gray-200">Cancel</button>
        </div>
      </div>
    </div>
    @endif
</div>
