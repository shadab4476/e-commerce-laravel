<div class="profile_edit_parent p-6  bg-black ">
    <div class="personal_info">
        <h2 class="text-3xl flex items-end font-medium text-yellow-500">Manage Address
        </h2>
        <div class="flex justify-center">
            <button class="text-[#2370f4]  secondary_font add_address_btn   text-2xl px-2 py-1  "
                type="button">Add+</button>
        </div>
        <form class="mt-5 hidden add_address_form" action="{{ route('update.addressDetail') }}"
            method="post">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="w-full justify-between  gap-x-10 flex items-center">
                <div class="w-1/2">
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <label for="addressName">Name</label>
                    <input id="addressName" class="w-full focus:outline-0 px-5 py-2" type="text"
                        value="{{ auth()->user()->name }}" name="name" required>
                </div>
                <div class="w-1/2">
                    @error('phone')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <label for="addressPhone">Phone</label>
                    <input id="addressPhone" class="w-full focus:outline-0 px-5 py-2"
                        placeholder="Ex:919999888877" type="number" value="{{ auth()->user()->phone }}"
                        min="123456789123" max="999999999999" name="phone" required>
                </div>
            </div>
            <div class="w-full justify-between  mt-3 gap-x-10 flex items-center">
                <div class="w-1/2">
                    @error('address')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <label for="addressAddress">Address</label>
                    <input id="addressAddress" placeholder="Address (Area and Street)"
                        class="w-full focus:outline-0 px-5 py-2" type="text"
                        value="{{ old('address') }}" name="address" required>
                </div>
                <div class="w-1/2">
                    @error('pincode')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <label for="addressPincode">Pincode</label>
                    <input id="addressPincode" value="{{ old('pincode') }}"
                        class="w-full focus:outline-0 px-5 py-2" placeholder="Pincode" type="number"
                        max="999999" min="111111" name="pincode" required>
                </div>
            </div>
            <div class="w-full justify-between  mt-3 gap-x-10 flex items-center">
                <div class="w-1/2">
                    @error('state')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <label for="addressState">State</label>
                    <select required class="text-black px-5 py-1 w-full" id="addressState"
                        name="state" id="addressState">
                        <option class="text-black first_state_null" value="">Select
                            State</option>
                        <option class="text-black" value="Andra Pradesh">Andra Pradesh
                        </option>
                        <option class="text-black" value="Arunachal Pradesh">Arunachal Pradesh
                        </option>
                        <option class="text-black" value="Assam">Assam</option>
                        <option class="text-black" value="Bihar">Bihar</option>
                        <option class="text-black" value="Chhattisgarh">Chhattisgarh</option>
                        <option class="text-black" value="Goa">Goa</option>
                        <option class="text-black" value="Gujarat">Gujarat</option>
                        <option class="text-black" value="Haryana">Haryana</option>
                        <option class="text-black" value="Himachal Pradesh">Himachal Pradesh
                        </option>
                        <option class="text-black" value="Jammu and Kashmir">Jammu and Kashmir
                        </option>
                        <option class="text-black" value="Jharkhand">Jharkhand</option>
                        <option class="text-black" value="Karnataka">Karnataka</option>
                        <option class="text-black" value="Kerala">Kerala</option>
                        <option class="text-black" value="Madya Pradesh">Madya Pradesh
                        </option>
                        <option class="text-black" value="Maharashtra">Maharashtra</option>
                        <option class="text-black" value="Manipur">Manipur</option>
                        <option class="text-black" value="Meghalaya">Meghalaya</option>
                        <option class="text-black" value="Mizoram">Mizoram</option>
                        <option class="text-black" value="Nagaland">Nagaland</option>
                        <option class="text-black" value="Orissa">Orissa</option>
                        <option class="text-black" value="Punjab">Punjab</option>
                        <option class="text-black" value="Rajasthan">Rajasthan</option>
                        <option class="text-black" value="Sikkim">Sikkim</option>
                        <option class="text-black" value="Tamil Nadu">Tamil Nadu</option>
                        <option class="text-black" value="Telangana">Telangana</option>
                        <option class="text-black" value="Tripura">Tripura</option>
                        <option class="text-black" value="Uttaranchal">Uttaranchal</option>
                        <option class="text-black" value="Uttar Pradesh">Uttar Pradesh
                        </option>
                        <option class="text-black" value="West Bengal">West Bengal</option>
                        <option class="text-black" value="Andaman and Nicobar Islands">Andaman
                            and Nicobar Islands
                        </option>
                        <option class="text-black" value="Chandigarh">Chandigarh</option>
                        <option class="text-black" value="Dadar and Nagar Haveli">Dadar and
                            Nagar Haveli</option>
                        <option class="text-black" value="Daman and Diu">Daman and Diu
                        </option>
                        <option class="text-black" value="Delhi">Delhi</option>
                        <option class="text-black" value="Lakshadeep">Lakshadeep</option>
                        <option class="text-black" value="Pondicherry">Pondicherry</option>
                    </select>
                </div>
                <div class="w-1/2">
                    @error('city')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <label for="addressCity">City</label>
                    <input id="addressCity" placeholder="City"
                        class="w-full focus:outline-0 px-5 py-2" type="text"
                        value="{{ old('city') }}" name="city" required>
                </div>
            </div>
            <div class="w-full justify-between  mt-3 gap-x-10 flex items-center">
                <div class="w-1/2">
                    <p class="text-lg mb-1 font-normal">Address Type</p>
                    <div class="flex gap-x-5">
                        @error('address_type')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="">
                            <label for="address_type1">Home</label>
                            <input type="radio" name="address_type" checked value="home"
                                id="address_type1">
                        </div>
                        <div class="">
                            <label for="address_type2">Work</label>
                            <input type="radio" name="address_type" value="work"
                                id="address_type2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2 mt-5">
                <button type="submit"
                    class="w-1/2  bg-yellow-600 py-3 hover:bg-yellow-500 font-bold transition-all">Save</button>
            </div>
        </form>
    </div>
</div>