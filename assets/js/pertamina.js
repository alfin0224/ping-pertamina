function konfirmasi_kirim()
{
	var konfirmasi = confirm("apakah anda yakin ingin mengirim data ini?")

	if (konfirmasi == true)
	{
		return true;
	}

	else
	{
		return false;
	}
}

function konfirmasi_reset()
{
	var konfirmasi = confirm("apakah anda yakin akan mereset data?")
	
	if (konfirmasi == true)
	{
		return true;
	}	
	else
	{
		return false;
	}
}

function konfirmasi_hapus()
{
	var konfirmasi = confirm("apakah anda yakin akan menghapus data ini?")
	
	if (konfirmasi == true)
	{
		return true;
	}

	else
	{
		return false;
	}
}

function konfirmasi_ubah()
{
	var konfirmasi = confirm("apakah anda yakin akan mengubah data ini?")

	if (konfirmasi == true)
	{
		return true;
	}

	else
	{
		return false;
	}
}